===source===
<?php abstract final class A { }
===errors===
cannot use 'abstract' and 'final' together on a class
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": true,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
===php_error===
PHP Fatal error:  Cannot use the final modifier on an abstract class in Standard input code on line 1
