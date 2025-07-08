<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

type Telefone = {
    id: number;
    user_id: number;
    _numero: string;
    created_at: string;
}

defineProps<{
    telefones: Telefone[]
}>();

const deleteTelefone = (id: number) => {
    if (confirm('Você tem certeza que deseja deletar este Telefone?')) {
        router.delete(route('delete-telefone', id));
    }
}

</script>

<template>
    <Head title="Lista de Telefones" />
        
    <div>
        <div class="flex justify-center items-center gap-6 mb-8 mt-4">
            <h1 class="text-2xl font-bold mb-0">Lista de Telefones</h1>
            <Link
                :href="route('register-telefone')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Registrar telefone
            </Link>
            <Link
                :href="route('dashboard')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de Pessoas
            </Link>
            <Link
                :href="route('lista-politicos')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de Políticos
            </Link>
        </div>
        <div class ="flex justify-center">
            <table class="table-auto border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Número</th>
                        <th class="px-4 py-2 border">Criado em</th>
                        <th class="px-4 py-2 border">Editar/Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="telefone in telefones" :key="telefone.id">
                        <td class="px-4 py-2 border">{{ telefone.id }}</td>
                        <td class="px-4 py-2 border">{{ telefone._numero }}</td>
                        
                        <td class="px-4 py-2 border">
                            {{ new Date(telefone.created_at).toLocaleString('pt-BR', { 
                                day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
                            }) }}
                        </td>
                        <Link
                            :href="route('edit-telefone', telefone.user_id)"
                            class="inline-block rounded-sm border border-[#19140035] 
                            px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                            dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                            >
                            Edit
                        </Link>
                        <Button
                            @click="deleteTelefone(telefone.id)"
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