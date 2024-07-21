<?php require basePath('views/partials/head.php') ?>
<?php require basePath('views/partials/nav.php') ?>
<?php require basePath('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-10">
            <a href="/notes" class="text-blue-500 underline">Go Back...</a>
        </p>
        <p class="text-xl mb-20">
            <?= htmlspecialchars($note['body']) ?>
        </p>

        <!-- <footer class="mt-10">
          <a href="/note/edit?id=<?= $note['id'] ?>" class="rounded-md bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>          
        </footer> -->


        <form class="mt-6 flex gap-x-4" method="POST">
            <a href="/note/edit?id=<?= $note['id'] ?>"
                class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
            <input hidden name="_method" value="DELETE">
            <input hidden name="id" type="text" value="<?= $note['id'] ?>">
            <button
                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
        </form>
    </div>
</main>
<?php require basePath('views/partials/footer.php') ?>