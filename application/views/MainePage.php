<div id="container" class=" mt-3">


    <div class="inline-flex rounded-md shadow-sm ml-3 mb-3" role="group">
        <a type="button" href="<?= base_url('index.php/CategoryController/create') ?>" class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Add Category
        </a>
        <a type="button" href="<?= base_url('index.php/ShoppingItemController/create') ?>" class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Add Item
        </a>
    </div>



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row  flex-wrap space-y-4 sm:space-y-0 justify-end  pb-4">
            <div class="mb-4 mr-2">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by category:</label>
                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4 mr-2">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by status:</label>
                <select id="status" name="status_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select a status</option>
                    <option value="sold">Sold</option>
                    <option value="available">Available</option>
                </select>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Item name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date by adding
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center  text-red-500 font-bold ">No data available</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    var globalFilter = '';

    function getItemsByCategories(filter) {
        $.ajax({
            url: "<?php echo site_url('ShoppingItemController/getItemsByCategories') ?>",
            type: "GET",
            dataType: "JSON",
            data: {
                filter: filter
            },
            success: function(data) {
                console.log(1);
                $('#container table tbody').empty();

                if (data.length > 0) {
                    $.each(data, function(index, item) {
                        var statusButton = item.purchased_status == 1 ?
                            '<button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">available</button>' :
                            '<button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">sold</button>';

                        var deleteUrl = "<?php echo site_url('ShoppingItemController/deleteItem/') ?>" + item.id;
                        var changeStatusUrl = "<?php echo site_url('ShoppingItemController/changeStatus/') ?>" + item.id;

                        var newRow = '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">' +
                            '<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + item.title + '</td>' +
                            '<td class="px-6 py-4">' + item.price + '</td>' +
                            '<td class="px-6 py-4">' + item.category_name + '</td>' +
                            '<td class="px-6 py-4">' + item.added_at + '</td>' +
                            '<td class="px-6 py-4 change-item" data-id="' + changeStatusUrl + '">' + statusButton + '</td>' +
                            '<td class="px-6 py-4">' +
                            '<a href="#" class="delete-item font-medium text-blue-600 dark:text-blue-500 hover:underline" data-url="' + deleteUrl + '">Delete</a>' +
                            '</td>' +
                            '</tr>';

                        $('#container table tbody').append(newRow);
                    });
                } else {
                    var defaultRow = ` <tr>
                    <td colspan="6" class="text-center  text-red-500 font-bold ">No data available</td>
                    </tr>`

                    $('#container table tbody').append(defaultRow);
                }
            }
        });
    }

    $(document).ready(function() {

        getItemsByCategories();

        $('#container').on('click', '.delete-item', function(e) {
            e.preventDefault();

            var deleteUrl = $(this).attr('data-url');

            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        console.log('Item deleted successfully');
                        getItemsByCategories(globalFilter);
                    } else {
                        console.error('Failed to delete item');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });

        $('#container').on('click', '.change-item', function(e) {
            e.preventDefault();

            var changeUrl = $(this).attr('data-id');

            $.ajax({
                url: changeUrl,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        console.log('Item change status');
                        getItemsByCategories(globalFilter);
                    } else {
                        console.error('Failed to change status');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });

        $('#category').add('#status').on('change', function() {
            globalFilter = $(this).val();
            getItemsByCategories(globalFilter);
        });
    });
</script>