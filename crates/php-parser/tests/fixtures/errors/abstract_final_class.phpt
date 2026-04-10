===source===
<?php
abstract final class Foo {}
final abstract class Bar {}
===errors===
cannot use 'abstract' and 'final' together on a class
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
    },
    {
      "kind": {
        "Class": {
          "name": "Bar",
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
