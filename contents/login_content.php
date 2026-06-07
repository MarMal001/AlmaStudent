<main class="row align-items-center text-white text-center">
    <div class="col-xl col"></div>
    <div class="col-xl-3 col-5 bg-deepskyblue text-center text-white rounded-4 d-flex justify-content-center">
        <form action="login.php" method="post" class="pt-5">
            <h2 class="text-white">Accedi al tuo account</h2>
            <ul>
                <li>
                    <label for="username" class="text-left form-label">
                        <h5>Username</h5>
                    </label>
                </li>
                <li>
                    <input type="email" id="username" name="username" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <label for="password" class="text-left form-label">
                        <h5>Password</h5>
                    </label>
                </li>
                <li>
                    <input type="password" id="password" name="password" class="form-control rounded-pill w-100" required />
                </li>
                <li>
                    <input type="submit" class="btn btn-secondary-subtle" value="Accedi" />
                </li>
                <li>
                    <a href="create_account.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Non hai un account?</a>
                </li>
            </ul>
        </form>
    </div>
    <div class="col-xl col"></div>
</main>
