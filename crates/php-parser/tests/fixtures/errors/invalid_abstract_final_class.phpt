===source===
<?php abstract final class Foo {}
===errors===
cannot use 'abstract' and 'final' together on a class
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
===php_error===
PHP Fatal error:  Cannot use the final modifier on an abstract class in Standard input code on line 1
