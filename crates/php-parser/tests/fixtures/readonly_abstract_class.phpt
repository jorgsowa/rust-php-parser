===config===
min_php=8.4
===source===
<?php readonly abstract class Foo {}
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