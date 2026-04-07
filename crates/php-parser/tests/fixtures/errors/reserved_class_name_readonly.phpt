===source===
<?php class readonly {}
===errors===
cannot use 'readonly' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "readonly",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
