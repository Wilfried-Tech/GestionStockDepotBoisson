initSwipeMenu();
initMenuClickListener();
initSection(3);

var search = $('article .search select');
var table = $('#factures');
var tableContent = table.innerHTML;

Clients.forEach(client => {
  var opt = document.createElement('option');
  opt.value = client.tel
  opt.innerText = client.nom
  search.appendChild(opt);
});

var Listes = [];
Factures.forEach(facture => {
  facture = Object.assign({}, facture);
  facture.client = Clients.filter((clt) => {
    return clt.tel == facture.client
  })[0];
  facture.produit = Boissons.filter((boisson) => {
    return boisson.id == facture.produit
  })[0];
  Listes.push(facture);
})

function afficher(factures) {
  table.innerHTML = tableContent;

  factures.forEach(fact => {
    table.innerHTML += `
    <tr>
      <td>${fact.client.nom}</td>
      <td>${fact.client.tel}</td>
      <td>${fact.produit.nom}</td>
      <td>${fact.produit.categorie}</td>
      <td>${fact.quantite}</td>
      <td>${fact.produit.prix_unitaire}</td>
      <td>${Number(fact.quantite)*Number(fact.produit.prix_unitaire)}</td>
      <td>${fact.payer}</td>
      <td>${fact.reste}</td>
      <td>${fact.client.dette}</td>
      <td>${fact.date_achat.split(' ')[0].replace(/\-/g,'/')}</td>
      <td>${fact.date_achat.split(' ')[1]}</td>
      <td><a href='../php/print.php?id=${fact.id}'><button>imprimer</button></a></td>
    </tr>
    `;
  })
}

search.onchange = function(e) {
  if (search.value == 'all') {
    afficher(Listes);
  } else {
    afficher(Listes.filter(f => {
      return f.client.tel == search.value
    }))
  }
}

afficher(Listes);