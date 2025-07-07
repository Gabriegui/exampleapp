<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    Nome: '',
    Telefone: '',
});

const submit = () => {
    form.post('register-telefone', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Número registrado!')
        },
    })
}

</script>

<template>
    <AuthBase title="Registre o Telefone" description="Pessoa precisa estar regstrada para o telefone ser validado.">
        <Head title="Telefone" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="Nome">Nome</Label>
                    <Input id="Nome" type="text" v-model="form.Nome" required placeholder="Nome completo" />
                    <p v-if="form.errors.Nome" class="text-sm text-red-600">{{ form.errors.Nome }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Apelido">Telefone</Label>
                    <Input id="Apelido" type="text" required autofocus :tabindex="2" v-model="form.Telefone" placeholder="Número completo" />
                    <p v-if="form.errors.Telefone" class="text-sm text-red-600">{{ form.errors.Telefone }}</p>
                </div>
            </div>

            <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                Registrar
            </Button>

            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('register')" :tabindex="5">Não registrou a pessoa?</TextLink>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Quer registrar um politico?</TextLink>
            </div>
        </form>
    </AuthBase>
</template>