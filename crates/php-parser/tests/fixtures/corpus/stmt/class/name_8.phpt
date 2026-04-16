===source===
<?php class A implements PARENT {}
===errors===
cannot use 'PARENT' as class name
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
                "PARENT"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 25,
                "end": 31
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
===php_error===
PHP Fatal error:  Cannot use "PARENT" as interface name, as it is reserved in Standard input code on line 1
