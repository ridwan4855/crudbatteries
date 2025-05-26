<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Battery List</h1>
        <a href="/batteries/create" class="bg-blue-500 text-white px-4 py-2 rou hover:bg-blue-600">
            Add New Battery
        </a>
    </div>
    <div class="overflow-x-auto">
        <table id="batteriesTable" class="w-full whitespace-nowrap">
            <thead>

                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Voltage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>

            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($batteries as $battery) : ?>
                <tr>
                    <td class="px-6 py-4"><?= $battery['name'] ?></td>
                    <td class="px-6 py-4"><?= $battery['type'] ?></td>
                    <td class="px-6 py-4"><?= $battery['voltage'] ?>V</td>
                    <td class="px-6 py-4"><?= $battery['capacity'] ?>mAh</td>
                    <td class="px-6 py-4">$<?= $battery['price'] ?></td>
                    <td class="px-6 py-4">
                        <a href="/batteries/edit/<?= $battery['id'] ?>"
                            class="text-white p-2 rounded bg-blue-500 hover:text-blue-700 mr-2">Edit</a>
                        <a href="/batteries/delete/<?= $battery['id'] ?>"
                            class="text-white p-2 rounded bg-red-500 hover:text-red-700"
                            onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#batteriesTable').DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        columnDefs: [{
            orderable: false,
            targets: 5
        }]
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>