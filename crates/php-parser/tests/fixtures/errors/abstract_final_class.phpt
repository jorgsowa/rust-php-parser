===source===
<?php
abstract final class Foo {}
final abstract class Bar {}
===errors===
cannot use 'abstract' and 'final' together on a class
cannot use 'abstract' and 'final' together on a class
===php_error===
PHP Fatal error:  Cannot use the final modifier on an abstract class in Standard input code on line 2
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
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Bar",
            "span": {
              "start": 55,
              "end": 58
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
        "start": 49,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
