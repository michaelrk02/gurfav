<div class="m-2">
    <div class="m-2">
        <?php echo form_open('admin/auth'); ?>
            <div class="m-2"><?php if (isset($status)) { status_message($status); } ?></div>
            <div class="form-group m-2">
                <label class="form-label" for="password">Kata sandi:</label>
                <input class="form-input" type="password" id="password" name="password" placeholder="Masukkan kata sandi">
            </div>
            <div class="m-2">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>
    </div>
</div>
