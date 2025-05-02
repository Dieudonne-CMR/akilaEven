Features détaillées
MVP réservations

1.  Saisie et notification initiale

        L’utilisateur renseigne ses données personnelles et les créneaux souhaités.

        À la soumission, l’administrateur est immédiatement notifié et la demande est enregistrée en base avec le statut Pending.

        Un e-mail automatique informe l’utilisateur de la bonne réception de sa demande.

2.  Cycle de vie de la réservation

    Pending → Accepted ou Cancelled (action de l’admin).

    Si Accepted, l’utilisateur dispose de 24 h pour confirmer → passe en Booked ou, à défaut, passe en Cancelled.

    Après confirmation (Booked), paiement → passe en Completed.

    À tout moment, l’admin peut forcer Cancelled à part si le statut est Completed.

3.  Gestion de la capacité

    Tant qu’il existe 5 réservations en Pending, Accepted (non expirées) ou Booked, la salle est indisponible.

    Une fois Completed, la place est libérée pour de nouvelles réservations, avec mention de la date de disponibilité. La mention de la date de disponibilité n'est pas afficher lorsqu'on arrive en date bde fin de la dernière réservation liée à la salle.
    Exemple simple: je réserve une salle dans la plateforme du 24/03/2025 au 26/03/2025. Le statut de la réservation arrive jusqu'à completed. Ce qui signifie que j'ai déjà payé la réservation. Dès lors la date de disponibilité de la salle est affichée aux utilisateurs(Salle disponible à partir du 26/03/2025). Maintenant le jour de la fin de la réservation arrive. On ne doit plus afficher la date de disponibilité de la salle aux utilisateurs.

Fonctionnalités ultérieures

4.  Job d’expiration automatique

    Mettre en place un scheduler (cron, queue worker) qui passe systématiquement en Cancelled les réservations Accepted non confirmées après 24 h, avec alertes de monitoring en cas d’échec.

5.  Processus de remboursement et politique d’annulation

    Définir clairement :

        Conditions de remboursement (intégral, frais, partiel) selon délai d’annulation.

        Automatisation de la relance ou du retour de fonds.

6.  Validation côté frontend et backend

    Vérifier format email, numéro de téléphone, cohérence date/heure (arrival < departure), gestion des fuseaux.

    Empêcher la saisie de créneaux déjà indisponibles en temps réel (AJAX ou WebSocket pour UX).

7.  Audit trail

    Stocker pour chaque changement de statut : identifiant de l’acteur (admin ou système), date/heure UTC, ancien et nouveau statut, raison (commentaire):
    À chaque fois qu’un événement important survient sur une réservation (création, changement de statut, annulation, modification de date…), vous enregistrez une entrée dans une table dédiée(reservation_audit) avec les informations suivantes :
    id Identifiant unique de l’entrée d’audit
    reservation_id La réservation concernée
    actor_type « user » (client) ou « admin » ou « system »
    actor_id Identifiant de l’utilisateur ou de l’admin (ou NULL pour système automatique)
    event Type d’événement (e.g. CREATED, STATUS_CHANGED, CANCELLED, PAYMENT_RECEIVED)
    from_status Ancien statut (peut être NULL à la création)
    to_status Nouveau statut
    timestamp Date/heure UTC de l’événement
    comment Optionnel : raison ou message libre (ex. « pas de confirmation dans les 24 h »)
    Exemple: L'admin recevra par exemple:

    -   L'utilisateur Ngako a demandé une réservation pour la salle « nom salle » du 24/03/2025 à 26/03/2025.
    -   L'utilisateur Ngako a confirmé la réservation pour la salle « nom salle » du 24/03/2025 à 26/03/2025.

    Exemple côté client:
    -Votre demande de réservation pour la salle « nom salle » du 24/03/2025 à 26/03/2025 est confirmée.

8.  UX de suivi et rappels

    Interface client : afficher le délai restant jusqu’à expiration des 24 h.

9.  Relance automatique (email/SMS) 2 h avant la fin du délai pour maximiser la confirmation.
