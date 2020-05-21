<datalist id="teachers">
    <?php foreach ($teachers_all as $teacher) { ?>
        <option value="<?php echo $teacher->name; ?>"><?php echo $teacher->name; ?> (<?php echo $teacher->course; ?>)</option>
    <?php } ?>
</datalist>
<div id="vote-list">
    <div class="columns">
        <div class="column col-2">
            <div class="input-group">
                <span class="input-group-addon">Kelas:</span>
                <select v-model="selectedCategory" class="form-select" v-on:change="onCategoryChange">
                    <option value="10_sci">X MIPA</option>
                    <option value="10_soc">X IPS</option>
                    <option value="11_sci">XI MIPA</option>
                    <option value="11_soc">XI IPS</option>
                    <option value="12_sci">XII MIPA</option>
                    <option value="12_soc">XII IPS</option>
                </select>
            </div>
        </div>
        <div class="column col-10 col-sm-12">
            <form method="get" v-bind:action="searchFormAction">
                <div class="input-group">
                    <span class="input-group-addon">Cari guru:</span>
                    <input type="text" list="teachers" class="form-input" v-model="search" placeholder="Masukkan nama/mata pelajaran">
                    <button type="submit" class="input-group-btn btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="m-2" style="overflow: auto">
        <?php foreach ($teachers as $teacher) { ?>
            <div class="card float-left" style="margin: 24px; box-shadow: 0px 0px 24px 0px lightgrey; width: 352px">
                <div class="card-image m-2">
                    <img src="<?php echo site_url('content/teacher_image/160/'.urlencode(base64_encode($teacher->name))); ?>" alt="Gambar tidak tersedia" class="d-block" height="160" style="margin-left: auto; margin-right: auto">
                </div>
                <div class="card-header">
                    <div class="card-title h5"><?php echo $teacher->name; ?> <span class="label label-rounded label-warning" v-if="chosenName == '<?php echo addslashes($teacher->name); ?>'">Terpilih</span></div>
                    <div class="card-subtitle text-gray"><?php echo $teacher->course; ?></div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" v-on:click="choose('<?php echo addslashes($teacher->name); ?>')">Pilih</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="columns">
        <div class="column col-4">
            <form method="get" v-bind:action="pageFormAction">
                <div class="input-group">
                    <span class="input-group-addon">Halaman:</span>
                    <select class="form-select" v-model="page">
                        <?php for ($i = 1; $i <= $page_max; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="input-group-btn btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>
        <div id="finish" class="column col-8 col-sm-12">
            <form method="get" v-bind:action="voteFormAction" onsubmit="return confirm('Apakah anda yakin?')">
                <div class="input-group">
                    <span class="input-group-addon">Guru terpilih:</span>
                    <input readonly class="form-input text-bold" v-model="chosenName">
                    <button type="submit" class="input-group-btn btn btn-success" v-bind:disabled="chosenName === ''">Selesai &raquo;</button>
                </div>
            </form>
        </div>
    </div>
    <div style="padding-top: 2em">
        <a class="btn btn-error" href="<?php echo site_url('user/logout'); ?>">Keluar</a>
    </div>
</div>
<script>

window.addEventListener('load', function() {
    var voteList = new Vue({
        el: '#vote-list',
        data: {
            url: '<?php echo base_url(); ?>',
            search: '<?php echo addslashes($search); ?>',
            page: <?php echo $page; ?>,
            items: <?php echo $items; ?>,
            chosenName: '',
            defaultCategory: '<?php echo $category; ?>',
            selectedCategory: null
        },
        mounted: function() {
            this.selectedCategory = this.defaultCategory;
        },
        computed: {
            searchFormAction: function() {
                return this.url + 'index.php/user/vote_list/' + this.selectedCategory + '/' + this.searchify(this.search) + '/1';
            },
            pageFormAction: function() {
                var search = '<?php echo addslashes($search); ?>';

                return this.url + 'index.php/user/vote_list/' + this.selectedCategory + '/' + this.searchify(search) + '/' + this.page;
            },
            voteFormAction: function() {
                return this.url + 'index.php/user/vote/' + encodeURIComponent(btoa(this.chosenName)) + '/' + this.selectedCategory;
            }
        },
        methods: {
            searchify: function(text) {
                return text === '' ? '_' : encodeURIComponent(btoa(text));
            },
            choose: function(name) {
                this.chosenName = name;
                window.location.href = '#finish';
            },
            onCategoryChange: function() {
                if (!confirm('Pilihan ini hanya dapat digunakan oleh panitia saja. Tetap ingin menggantinya?')) {
                    this.selectedCategory = this.defaultCategory;
                } else {
                    this.defaultCategory = this.selectedCategory;
                }
            }
        }
    })
});

</script>
