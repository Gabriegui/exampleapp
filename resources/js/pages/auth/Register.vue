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
    Endereço: '',
    CPF: '',
    Gênero: '',
});

const submit = () => {
    form.post('/register', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Pessoa registrada!')
        },
    })
}

</script>

<template>
    <AuthBase title="Registre a pessoa" description="Preencha as informações necessárias">
        <Head title="Pessoa" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="Nome">Nome</Label>
                    <Input id="Nome" type="text" required autofocus :tabindex="1" v-model="form.Nome" placeholder="Nome completo" />
                    <p v-if="form.errors.Nome" class="text-sm text-red-600">{{ form.errors.Nome }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="Endereço">Endereço</Label>
                    <Input id="Endereço" type="text" required :tabindex="2" v-model="form.Endereço" placeholder="Endereço" />
                    <p v-if="form.errors.Endereço" class="text-sm text-red-600">{{ form.errors.Endereço }}</p>
                </div>

                <div class="grid gap-2">
                    <Label for="CPF">CPF</Label>
                    <Input id="CPF" type="text" required :tabindex="3" v-model="form.CPF" placeholder="CPF" />
                    <p v-if="form.errors.CPF" class="text-sm text-red-600">{{ form.errors.CPF }}</p>
                </div>

                <div>
                    <Label for="Gênero">Gênero:</Label>
                    <input type="radio" id="masc" name="Gênero" v-model="form.Gênero" value="Masculino">
                    <label for="masc">Masculino</label><br>
                    <input type="radio" id="fem" name="Gênero" v-model="form.Gênero" value="Feminino">
                    <label for="fem">Feminino</label><br>
                    <p v-if="form.errors.Gênero" class="text-sm text-red-600">{{ form.errors.Gênero }}</p>
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Registrar
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Quer registrar um politico?</TextLink>
            </div>
            
            <div class="text-center text-sm text-muted-foreground">
                <TextLink :href="route('/register-telefone')" :tabindex="5">Quer registrar telefone?</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
