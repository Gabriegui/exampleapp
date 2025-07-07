<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps(["telefone"]);
const form = useForm({
    _numero: props.telefone._numero,
});

</script>

<template>
    <AuthBase title="Edite o telefone" description="Preencha as informações necessárias">
        <Head title="Edit telefone" />

        <form @submit.prevent="form.put(route('update-telefone', {id: telefone.user_id}))" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="_numero">Número completo</Label>
                    <Input id="_numero" type="text" required autofocus :tabindex="1" v-model="form._numero" placeholder="Nome completo" />
                    <p v-if="form.errors._numero" class="text-sm text-red-600">{{ form.errors._numero }}</p>
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Salvar
                </Button>
            </div>
        </form>
    </AuthBase>
</template>