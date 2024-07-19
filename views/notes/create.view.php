<?php require basePath('views/partials/head.php') ?>
<?php require basePath('views/partials/nav.php') ?>
<?php require basePath('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-6xl py-6 sm:px-6 lg:px-8">        
    <form method="POST" action="/notes">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
            <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Add a note</label>
            <div class="mt-2">
                <textarea id="body" name="body" rows="3" required placeholder="Write something..." class="block w-full rounded-md border-0 p-5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= isset($_POST['body']) ? $_POST['body'] : NULL ?></textarea>
            </div>
                <?php if (isset($errors['body'])) : ?>
                    <p class="text-red-500 text-s mt-5 ml-5"><?= $errors['body'] ?></p>
                <?php endif ?>
            </div>      
        </div>
        </div>
    </div>
    <div class="mt-6 flex items-center justify-center gap-x-6">
        <button type="button" onclick="location.href='/notes'" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
    </form>
    </div>
</main>

<?php require basePath('views/partials/footer.php') ?>