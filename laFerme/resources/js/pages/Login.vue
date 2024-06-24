<template>
    <div class="flex items-center justify-center flex-col">
        <img
            src="../../assets/logo/logo.svg"
            alt="Logo de la ferme"
            class="w-64 h-64"
        />
        <form class="max-w-lg w-full m-auto h-72">
            <div class="mb-4">
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Email</label
                >
                <input
                    type="email"
                    id="email"
                    name="email"
                    autocomplete="email"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <label
                    for="password"
                    class="block text-sm font-medium text-gray-700"
                    >Mot de passe</label
                >
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <button
                    type="submit"
                    class="w-full p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                >
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</template>
