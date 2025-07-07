<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

type Político = {
    user_id: number;
    Nome_guerra: string;
    numero_urna: string;
    partido: string;
    created_at: string;
}

defineProps<{
    politicos: Político[]
}>();

const deletePolitico = (id: number) => {
    if (confirm('Você tem certeza que deseja deletar este político?')) {
        router.delete(route('delete-politico', id));
    }
}

</script>

<template>
    <Head title="Lista de Políticos" />
        
    <div>
        <div class="flex justify-center items-center gap-6 mb-8 mt-4">
            <h1 class="text-2xl font-bold mb-0">Lista de Políticos</h1>
            <Link
                :href="route('login')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Registrar político
            </Link>
            <Link
                :href="route('dashboard')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de pessoas
            </Link>
            <Link
                :href="route('lista-telefone')"
                class="inline-block rounded-sm border border-[#19140035] 
                px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Lista de Telefones
            </Link>
        </div>
        <div class ="flex justify-center">
            <table class="table-auto border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Apelido</th>
                        <th class="px-4 py-2 border">Partido</th>
                        <th class="px-4 py-2 border">Número</th>
                        <th class="px-4 py-2 border">Criado em</th>
                        <th class="px-4 py-2 border">Editar/Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="politico in politicos" :key="politico.user_id">
                        <td class="px-4 py-2 border">{{ politico.user_id }}</td>
                        <td class="px-4 py-2 border">{{ politico.Nome_guerra }}</td>
                        <td class="px-4 py-2 border">{{ politico.partido }}</td>
                        <td class="px-4 py-2 border">{{ politico.numero_urna }}</td>
                        <td class="px-4 py-2 border">
                            {{ new Date(politico.created_at).toLocaleString('pt-BR', { 
                                day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
                            }) }}
                        </td>
                        <Link
                            :href="route('edit-politico', politico.user_id)"
                            class="inline-block rounded-sm border border-[#19140035] 
                            px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] 
                            dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                            >
                            Edit
                        </Link>
                        <Button
                            @click="deletePolitico(politico.user_id)"
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