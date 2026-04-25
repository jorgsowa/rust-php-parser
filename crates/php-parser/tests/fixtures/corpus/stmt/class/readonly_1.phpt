===config===
min_php=8.2
===source===
<?php

readonly class A {
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
        "start": 16,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}