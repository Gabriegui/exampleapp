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
    Apelido: '',
    Partido: '',
    Urna: '',
    Eleicao: '',
});

const submit = () => {
    form.post('/login', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Político registrado!')
        },
    })
}

</script>

<template>
    <AuthBase title="Registre o político" description="Pessoa precisa estar regstrada para o político ser validado.">
        <Head title="Político" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="Nome">Nome do político</Label>
                    <Input id="Nome" type="text" v-model="form.Nome" required placeholder="Nome completo" />
                    <p v-if="form.errors.Nome" class="text-sm text-red-600">{{ form.errors.Nome }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Apelido">Apelido</Label>
                    <Input id="Apelido" type="text" required autofocus :tabindex="2" v-model="form.Apelido" placeholder="Apelido completo" />
                    <p v-if="form.errors.Apelido" class="text-sm text-red-600">{{ form.errors.Apelido }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Partido">Nome do partido</Label>
                    <Input id="Partido" type="text" required :tabindex="3" v-model="form.Partido" placeholder="Partido" />
                    <p v-if="form.errors.Partido" class="text-sm text-red-600">{{ form.errors.Partido }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Urna">Número do partido</Label>
                    <Input id="Urna" type="text" required :tabindex="4" v-model="form.Urna" placeholder="Número da urna" />
                    <p v-if="form.errors.Urna" class="text-sm text-red-600">{{ form.errors.Urna }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Eleicao">Ano de eleição</Label>
                    <Input id="Eleicao" type="text" required :tabindex="5" v-model="form.Eleicao" placeholder="Ano" />
                    <p v-if="form.errors.Eleicao" class="text-sm text-red-600">{{ form.errors.Eleicao }}</p>
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Registrar
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('register')" :tabindex="5">Não registrou a pessoa?</TextLink>
            </div>
            
            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('register-telefone')" :tabindex="5">Quer registrar telefone?</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
