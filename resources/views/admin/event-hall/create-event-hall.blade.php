@extends('admin.layouts.layout-admin')
@section('content-admin')

@if(session()->has('success'))
    <x-ui.toast type="success" message="{{ session('success') }}" position="bottom-right" />
@endif

@if(session()->has('error'))
    <x-ui.toast type="error" message="{{ session('error') }}" position="bottom-right" />
@endif

<x-admin.dashboard-panel>
   <!-- Entête de la page -->
   <x-admin.event-hall-header :hotel="$hotel" />
  
   <!-- Formulaire -->
   <form action="{{ route('admin.event-hall.store', $hotel->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 lg:grid-cols-3">
       @csrf
      <!-- Sidebar - Images Upload -->
      <div class="lg:col-span-1">
          <x-admin.event-hall-images :errors="$errors" />
      </div>
      
      <!-- Form Fields -->
      <div class="lg:col-span-2">
          <x-admin.event-hall-form :hotel="$hotel" :villes="$villes" />
      </div>
   </form>
</x-admin.dashboard-panel>
@endsection

@push('scripts')
<script type="module">
    import { Editor } from 'https://esm.sh/@tiptap/core@2.11.0';
    import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.11.0';
    import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder@2.11.0';
    import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph@2.11.0';
    import Bold from 'https://esm.sh/@tiptap/extension-bold@2.11.0';
    import Underline from 'https://esm.sh/@tiptap/extension-underline@2.11.0';
    import Link from 'https://esm.sh/@tiptap/extension-link@2.11.0';
    import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list@2.11.0';
    import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list@2.11.0';
    import ListItem from 'https://esm.sh/@tiptap/extension-list-item@2.11.0';
    import Blockquote from 'https://esm.sh/@tiptap/extension-blockquote@2.11.0';
  
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser Lucide icons
        if (window.lucide) {
            lucide.createIcons();
        }
        
        const editor = new Editor({
            element: document.querySelector('#hs-editor-tiptap [data-hs-editor-field]'),
            editorProps: {
                attributes: {
                    class: 'relative min-h-40 p-3'
                }
            },
            extensions: [
                StarterKit.configure({
                    history: false
                }),
                Placeholder.configure({
                    placeholder: 'Règlement de la salle de réception...',
                    emptyNodeClass: 'before:text-gray-500'
                }),
                Paragraph.configure({
                    HTMLAttributes: {
                        class: 'text-inherit text-gray-800'
                    }
                }),
                Bold.configure({
                    HTMLAttributes: {
                        class: 'font-bold'
                    }
                }),
                Underline,
                Link.configure({
                    HTMLAttributes: {
                        class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium'
                    }
                }),
                BulletList.configure({
                    HTMLAttributes: {
                        class: 'list-disc list-inside text-gray-800'
                    }
                }),
                OrderedList.configure({
                    HTMLAttributes: {
                        class: 'list-decimal list-inside text-gray-800'
                    }
                }),
                ListItem.configure({
                    HTMLAttributes: {
                        class: 'marker:text-sm'
                    }
                }),
                Blockquote.configure({
                    HTMLAttributes: {
                        class: 'relative border-s-4 ps-4 sm:ps-6 sm:[&>p]:text-lg'
                    }
                })
            ],
            onUpdate: ({ editor }) => {
                // Mettre à jour le champ caché avec le HTML de l'éditeur
                document.getElementById('rules-content').value = editor.getHTML();
            }
        });
        
        // Récupérer les boutons d'action et configurer les événements
        const actions = [
            {
                id: '#hs-editor-tiptap [data-hs-editor-bold]',
                fn: () => editor.chain().focus().toggleBold().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-italic]',
                fn: () => editor.chain().focus().toggleItalic().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-underline]',
                fn: () => editor.chain().focus().toggleUnderline().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-strike]',
                fn: () => editor.chain().focus().toggleStrike().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-link]',
                fn: () => {
                    const url = window.prompt('URL');
                    if (url) {
                        editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
                    }
                }
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-ol]',
                fn: () => editor.chain().focus().toggleOrderedList().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-ul]',
                fn: () => editor.chain().focus().toggleBulletList().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-blockquote]',
                fn: () => editor.chain().focus().toggleBlockquote().run()
            },
            {
                id: '#hs-editor-tiptap [data-hs-editor-code]',
                fn: () => editor.chain().focus().toggleCode().run()
            }
        ];
      
        actions.forEach(({ id, fn }) => {
            const action = document.querySelector(id);
            if (action) {
                action.addEventListener('click', fn);
            }
        });
        
        // Initialiser l'éditeur avec les données existantes si disponibles
        const oldRules = "{{ old('rules') }}";
        if (oldRules) {
            editor.commands.setContent(oldRules);
        }
    });
</script>
@endpush


