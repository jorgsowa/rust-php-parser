===config===
min_php=8.2
===source===
<?php

final readonly class A {
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 22,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}