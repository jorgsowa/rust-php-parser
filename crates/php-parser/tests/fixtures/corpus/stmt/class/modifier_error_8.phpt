===source===
<?php abstract final class A { }
===errors===
expected 'class', found 'final'
===ast===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
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
