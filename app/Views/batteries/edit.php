<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Edit Battery</h2>

    <?php if (session()->has('errors')) : ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            <?php foreach (session('errors') as $error) : ?>
            <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php endif ?>

    <form action="/batteries/update/<?= $battery['id'] ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="<?= old('name', $battery['name']) ?>"
                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
            <select name="type" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="">Select Battery Type</option>
                <?php foreach ($types as $type) : ?>
                <option value="<?= $type['id'] ?>"
                    <?= $type['id'] == old('type', $battery['type']) ? 'selected' : '' ?>>
                    <?= $type['type_name'] ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Voltage (V)</label>
                <input type="number" step="0.01" name="voltage" value="<?= old('voltage', $battery['voltage']) ?>"
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Capacity (mAh)</label>
                <input type="number" name="capacity" value="<?= old('capacity', $battery['capacity']) ?>"
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Price ($)</label>
            <input type="number" step="0.01" name="price" value="<?= old('price', $battery['price']) ?>"
                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="/batteries" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update
                Battery</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>