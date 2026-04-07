===source===
<?php class { }
===errors===
expected class name, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "<error>",
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
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
