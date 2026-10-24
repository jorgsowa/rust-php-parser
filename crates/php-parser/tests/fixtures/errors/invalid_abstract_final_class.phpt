===source===
<?php abstract final class Foo {}
===errors===
Cannot use the final modifier on an abstract class
===php_error===
PHP Fatal error:  Cannot use the final modifier on an abstract class in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 27,
              "end": 30
            }
          },
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
