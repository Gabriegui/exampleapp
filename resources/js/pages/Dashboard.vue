<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

type Pessoa = {
    id: number;
    Nome: string;
    Endereço: string;
    CPF: string;
    Gênero: string;
    created_at: string;
}

defineProps<{
    pessoas: Pessoa[]
}>();

const deletePessoa = (id: number) => {
    if (confirm('Você tem certeza que deseja deletar esta pessoa?')) {
        router.delete(route('delete-pessoa', id));
    }
}

</script>

<template>
    <Head title="Lista de pessoas" />
        
    <div>
        <div class="flex justify-center items-center gap-6 mb-8 mt-4">
            <h1 class="text-2xl font-bold mb-0">Lista de Pessoas</h1>
            <Link
                :href="route('register')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Registrar pessoa
            </Link>
            <Link
                :href="route('lista-politicos')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de Políticos
            </Link>
            <Link
                :href="route('lista-telefone')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de Telefones
            </Link>
            <Link
                :href="route('home')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Voltar para Menu
            </Link>
        </div>
        <div class ="flex justify-center">
            <table class="table-auto border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nome</th>
                        <th class="px-4 py-2 border">Endereço</th>
                        <th class="px-4 py-2 border">CPF</th>
                        <th class="px-4 py-2 border">Gênero</th>
                        <th class="px-4 py-2 border">Criado em</th>
                        <th class="px-4 py-2 border">Editar/Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pessoa in pessoas" :key="pessoa.id">
                        <td class="px-4 py-2 border">{{ pessoa.id }}</td>
                        <td class="px-4 py-2 border">{{ pessoa.Nome }}</td>
                        <td class="px-4 py-2 border">{{ pessoa.Endereço }}</td>
                        <td class="px-4 py-2 border">{{ pessoa.CPF }}</td>
                        <td class="px-4 py-2 border">{{ pessoa.Gênero }}</td>
                        <td class="px-4 py-2 border">
                            {{ new Date(pessoa.created_at).toLocaleString('pt-BR', { 
                                day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
                            }) }}
                        </td>
                        <Link
                            :href="route('edit-pessoa', pessoa.id)"
                            class="inline-block rounded-sm border border-[#19140035] 
                            px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                            dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                            >
                            Edit
                        </Link>
                        <Button
                            @click="deletePessoa(pessoa.id)"
                            class="inline-block rounded-sm border border-[#19140035] 
                            px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                            dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                            >
                            Delete
                        </Button>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
