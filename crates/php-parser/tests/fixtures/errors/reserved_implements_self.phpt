===source===
<?php class A implements self {}
===errors===
cannot use 'self' as class name
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
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 25,
                "end": 29
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
===php_error===
PHP Fatal error:  Cannot use "self" as interface name, as it is reserved in Standard input code on line 1
