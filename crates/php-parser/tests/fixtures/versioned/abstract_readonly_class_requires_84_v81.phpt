===config===
min_php=8.1
max_php=8.1
===source===
<?php abstract readonly class Foo {}
===errors===
'abstract readonly class' requires PHP 8.4 or higher (targeting PHP 8.1)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 24,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 1
