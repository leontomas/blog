<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // masteradmin
        DB::table('users')->insert([
            'username'=>'masteradmin',
            'password'=> Hash::make('123456'),
            'first_name'=>'Adam',
            'last_name'=>'Warlock',
            'email'=>'masteradmin@mail.com',
            'role'=>'administrator',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
/* 
        // author
        DB::table('users')->insert([
            'username'=>'pcoelho',
            'password'=> Hash::make('123456'),
            'first_name'=>'Paolo',
            'last_name'=>'Coelho',
            'email'=>'pcoelho@mail.com',
            'role'=>'author',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        // author
        DB::table('users')->insert([
            'username'=>'malbom',
            'password'=> Hash::make('123456'),
            'first_name'=>'Mitch',
            'last_name'=>'Albom',
            'email'=>'malbom@mail.com',
            'role'=>'author',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        // Test Account
        DB::table('users')->insert([
            'username'=>'delete',
            'password'=> Hash::make('123456'),
            'first_name'=>'delete',
            'last_name'=>'delete',
            'email'=>'delete@mail.com',
            'role'=>'author',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
*/
        // blog post
        DB::table('blogs')->insert([
            'title'=>'MY WRITING TIPS',
            'category'=> 'Book and writing',
            'summary'=>'On Confidence You cannot sell your next book by underrating your book that was just published. Be proud of what you have. On Trust Trust your reader, don’t try to describe things. Give a hint and they will fulfill this hint with their own imagination. On Expertise You cannot take something out of nothing. When [...]',
            'content'=>'On Confidence You cannot sell your next book by underrating your book that was just published. Be proud of what you have.
            On Trust Trust your reader, don’t try to describe things. Give a hint and they will fulfill this hint with their own imagination.
            On Expertise You cannot take something out of nothing. When you write a book, use your experience.
            On Critics Some writers want to please their peers, they want to be “recognized”. This shows insecurity and nothing else, please forget about this. You should care to share your soul and not to please other writers.
            On Taking notes If you want to capture ideas, you are lost. You are going to be detached from emotions and forget to live your life. You will be an observer and not a human being living his or her life. Forget taking notes. What is important remains, what is not important goes away.
            On Research If you overload your book with a lot of research, you are going to be very boring to yourself and to your reader. Books are not there to show how intelligent you are. Books are there to show your soul.
            On Writing I write the book that wants to be written. Behind the first sentence is a thread that takes you to the last.
            On Style Don’t try to innovate storytelling, tell a good story and it is magical. I see people trying to work so much in style, finding different ways to tell the same thing. It’s like fashion. Style is the dress, but the dress does not dictate what is inside the dress.',
            'tag'=>'writingtips',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        // 
        DB::table('blogs')->insert([
            'title'=>'Be Like a River',
            'category'=> 'Book and writing',
            'summary'=>'by Paulo Coelho "A river never passes the same place twice,” says a philosopher. “Life is like a river,” says another philosopher, and we draw the conclusion that this is the metaphor that comes closest to the meaning of life. Consequently, it is always good to remember during all the year to come: [...]',
            'content'=>'“A river never passes the same place twice,” says a philosopher. “Life is like a river,” says another philosopher, and we draw the conclusion that this is the metaphor that comes closest to the meaning of life. Consequently, it is always good to remember during all the year to come:
                A] We are always doing things for the first time. While we move between our source (birth) to our destination (death), the landscape will always be new. We should face these novelties with joy, not with fear – because it is useless to fear what cannot be avoided. A river never stops running.
                B] In a valley we walk slower. When everything around us becomes easier, the waters grow calm, we become more open, fuller and more generous.
                C] Our banks are always fertile. Vegetation only grows where there is water. Whoever comes into contact with us needs to understand that we are there to give the thirsty something to drink.           
                D] Stones should be avoided. It is obvious that water is stronger than granite, but it takes time for this to happen. It is no good letting yourself be overcome by stronger obstacles, or trying to fight against them – that is a useless waste of energy. It is best to understand where the way out is, and then move forward.
                E] Hollows call for patience. All of a sudden the river enters a sort of hole and stops running as joyfully as before. At such moments the only way out is to count on the help of time. When the right moment comes the hollow fills up and the water can flow ahead. In the place of the ugly, lifeless hole there now stands a lake that others can contemplate with joy.           
                F] We are one. We were born in a place that was meant for us, which will always keep us supplied with enough water so that when confronted with obstacles or depression we have the necessary patience or strength to move forward. We begin our course in a soft and fragile manner, where even a simple leaf can stop us. Nevertheless, as we respect the mystery of the source that gave us life, and trust in eternal wisdom, little by little we gain all that we need to pursue our path.
                G] Although we are one, soon we shall be many. As we travel on, the waters of other springs come closer, because that is the best path to follow. Then we are no longer just one, but many – and there comes a moment when we feel lost. However, “all rivers flow to the sea.” It is impossible to remain in our solitude, no matter how romantic that may seem. When we accept the inevitable encounter with other springs, we eventually understand that this makes us much stronger, we get around obstacles or fill in the hollows in far less time and with greater ease.
                H] We are a means of transportation. Of leaves, boats, ideas. May our waters always be generous, may be always be able to carry ahead everything or everyone that needs our help.
                I] We are a source of inspiration. And so, let us leave the final words to the Brazilian poet, Manuel Bandeira:
                “To be like a river that flows
                silent through the night,
                not fearing the darkness and
                reflecting any stars high in the sky.',
            'tag'=>'paulocoelho',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('blogs')->insert([
            'title'=>'Test Update1',
            'category'=> 'Test Blog',
            'summary'=>'Test Blog',
            'content'=>'Test Blog',
            'tag'=>'testblog',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        
        DB::table('blogs')->insert([
            'title'=>'Test Update2',
            'category'=> 'Test Blog',
            'summary'=>'Test Blog',
            'content'=>'Test Blog',
            'tag'=>'testblog',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('blogs')->insert([
            'title'=>'Test Delete1',
            'category'=> 'Test Blog',
            'summary'=>'Test Blog',
            'content'=>'Test Blog',
            'tag'=>'testblog',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('blogs')->insert([
            'title'=>'Test Delete2',
            'category'=> 'Test Blog',
            'summary'=>'Test Blog',
            'content'=>'Test Blog',
            'tag'=>'testblog',
            'user_id'=>'2',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
    }
}
