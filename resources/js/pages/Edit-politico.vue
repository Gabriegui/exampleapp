<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps(["politico"]);
const form = useForm({
    Nome_guerra: props.politico.Nome_guerra,
    partido: props.politico.partido,
    numero_urna: props.politico.numero_urna
});

</script>

<template>
    <AuthBase title="Edite o politico" description="Preencha as informações necessárias">
        <Head title="Edit politico" />

        <form @submit.prevent="form.put(route('update-politico', {id: politico.user_id}))" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="Nome_guerra">Nome</Label>
                    <Input id="Nome_guerra" type="text" required autofocus :tabindex="1" v-model="form.Nome_guerra" placeholder="Nome completo" />
                    <p v-if="form.errors.Nome_guerra" class="text-sm text-red-600">{{ form.errors.Nome_guerra }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="partido">Partido</Label>
                    <Input id="partido" type="text" required :tabindex="2" v-model="form.partido" placeholder="Partido" />
                    <p v-if="form.errors.partido" class="text-sm text-red-600">{{ form.errors.partido }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="numero_urna">Urna</Label>
                    <Input id="numero_urna" type="text" required :tabindex="3" v-model="form.numero_urna" placeholder="Urna" />
                    <p v-if="form.errors.numero_urna" class="text-sm text-red-600">{{ form.errors.numero_urna }}</p>
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Salvar
                </Button>
            </div>
        </form>
    </AuthBase>
</template>