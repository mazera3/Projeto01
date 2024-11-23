import InfoButton from "@/Components/Button/InfoButton";
import SuccessButton from "@/Components/Button/SuccessButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function ProfessorCriar() {

    // Receber os dados do formulário
    const { data, setData, post, processing, errors} = useForm({
       name: '',
       email: '',
       matricula: '',
       password: '',
       password_confirmation: '',
   });

   // Enviar os dados para a rota cadastrar através do método POST
   const handleSubmit = (e) => {

       // Não recarregar a página
       e.preventDefault(); 
       // console.log("Cadastrar ...")
       // Enviar os dados para a rota de criação de professor
       post(route('professores.salvar'));
   };

   return (
       <AuthenticatedLayout>
           <Head title="Cadastrar Professor" />

           <div className="max-w-8xl mx-auto px-1 sm:px-0 lg:px-0">
               <div className="flex justify-between items-center">
                   <h2 className="text-xl font-semibold leading-tight text-gray-600 dark:text-gray-200">
                       Professor
                   </h2>
                   <nav className="text-sm text-gray-500 dark:text-gray-400">
                       <Link href={route('dashboard')} className="hover:text-gray-700 dark:hover:text-gray-300">
                           Dashboard
                       </Link>
                       <span className="mx-1">/</span>
                       <Link href={route('users.index')} className="hover:text-gray-700 dark:hover:text-gray-300">
                           Professores
                       </Link>
                       <span className="mx-1">/</span>
                       <span>Cadastrar</span>
                   </nav>
               </div>
           </div>

           <div className="py-4 mx-auto max-w-8xl px-1 sm:px-0 lg:px-0">
               <div className="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                   <div className="flex justify-between items-center p-3">
                       <h3 className="text-lg">Cadastrar um novo Professor</h3>
                       <div className="flex space-x-4">
                       <Link href={route('professores.listar')}>
                               <InfoButton className="text-sm">
                                   Listar
                               </InfoButton>
                           </Link>
                       </div>
                   </div>

                   {/* Formulário cadastrar professores */}
                   <div className="px-4 py-4">
                       <form onSubmit={handleSubmit}>
                           <div className="mb-4">
                               <label htmlFor="name" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                               <input
                                   id="name"
                                   type="text"
                                   placeholder="Nome completo do professor"
                                   value={data.name}
                                   onChange={(e) => setData('name', e.target.value)}
                                   className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                                //    required
                               />
                               {errors.name && <span className="text-red-600">{errors.name}</span>}
                           </div>

                           <div className="mb-4">
                               <label htmlFor="matricula" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Matricula</label>
                               <input
                                   id="matricula"
                                   type="text"
                                   placeholder="Nº de matricula do professor"
                                   value={data.matricula}
                                   onChange={(e) => setData('matricula', e.target.value)}
                                   className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                                   required
                               />
                               {errors.matricula && <span className="text-red-600">{errors.matricula}</span>}
                           </div>

                           <div className="mb-4">
                               <label htmlFor="email" className="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                               <input
                                   id="email"
                                   type="text"
                                   placeholder="Melhor e-mail do professor"
                                   value={data.email}
                                   onChange={(e) => setData('email', e.target.value)}
                                   className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                                   required
                               />
                               {errors.email && <span className="text-red-600">{errors.email}</span>}
                           </div>

                           <div className="mb-4">
                               <label htmlFor="password" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                               <input
                                   id="password"
                                   type="password"
                                   autoComplete="password"
                                   value={data.password}
                                   onChange={(e) => setData('password', e.target.value)}
                                   placeholder="Senha para o professor acessar o sistema"
                                   className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                                   required
                               />
                               {errors.password && <span className="text-red-600">{errors.password}</span>}
                           </div>

                           <div className="mb-4">
                               <label htmlFor="password_confirmation" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Senha</label>
                               <input
                                   id="password_confirmation"
                                   type="password"
                                   autoComplete="password_confirmation"
                                   value={data.password_confirmation}
                                   onChange={(e) => setData('password_confirmation', e.target.value)}
                                   placeholder="Confirmar a senha"
                                   className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                                   required
                               />
                               {errors.password_confirmation && <span className="text-red-600">{errors.password_confirmation}</span>}
                           </div>
                           <div className="flex justify-end">
                               <SuccessButton
                                   type="submit"
                                   disabled={processing}
                                   className="text-sm"
                               >Cadastrar</SuccessButton>
                           </div>
                       </form>
                   </div>

               </div>
           </div>
       </AuthenticatedLayout>
   )
}