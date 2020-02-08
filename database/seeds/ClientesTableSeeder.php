<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'razao_social'      => 'Kaza Arquitetura Ltda',
                'nome_fantasia'     => 'Kaza Arquitetura',
                'cnpj'              => '22478404000128',
                'endereco'          => 'Rua Santa Carolina',
                'email'             => 'kazaarquitetura@gmail.com',
                'telefone'          => '4738020641',
                'nome_responsavel'  => 'Amanda Cristiane Silveira',
                'cpf'               => '74695721473',
                'celular'           => '47994622862',
            ],
            [
                'razao_social'      => 'Xpressi Comércio Exterior Ltda',
                'nome_fantasia'     => 'Xpressi',
                'cnpj'              => '65691157000156',
                'endereco'          => 'Rua das Palmeiras',
                'email'             => 'xpressicomercio@hotmail.com',
                'telefone'          => '5135161489',
                'nome_responsavel'  => 'Osvaldo José Souza',
                'cpf'               => '83328575383',
                'celular'           => '51994674705',
            ],
            [
                'razao_social'      => 'CriArte Organização de Eventos Ltda',
                'nome_fantasia'     => 'CriArte',
                'cnpj'              => '22041901000164',
                'endereco'          => 'Rua Padre Antônio Vieira',
                'email'             => 'criartltda@gmail.com',
                'telefone'          => '7128905557',
                'nome_responsavel'  => 'Patrícia Rafaela Yasmin Alves',
                'cpf'               => '63489167236',
                'celular'           => '71994148957',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'razao_social'      => 'Magnetis Consultoria de Investimentos ME',
                'nome_fantasia'     => 'Magnetis',
                'cnpj'              => '20024918000188',
                'endereco'          => 'Rua Clarêncio Jucá',
                'email'             => 'magnetisconsultoria@outlook.com',
                'telefone'          => '8226209873',
                'nome_responsavel'  => 'Gustavo Davi Drumond',
                'cpf'               => '73328107274',
                'celular'           => '82998646020',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'razao_social'      => 'MSS Panificadora Ltda. EPP',
                'nome_fantasia'     => 'Padaria Estrela',
                'cnpj'              => '19097265000188',
                'endereco'          => 'Beco Santo Antônio',
                'email'             => 'msspanificadora@outlook.com',
                'telefone'          => '3137507384',
                'nome_responsavel'  => 'Mateus Pietro Silva',
                'cpf'               => '53992294471',
                'celular'           => '31999629683',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
