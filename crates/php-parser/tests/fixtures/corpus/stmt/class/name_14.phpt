===source===
<?php interface A extends PARENT {}
===errors===
cannot use 'PARENT' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "A",
          "extends": [
            {
              "parts": [
                "PARENT"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 32
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
===php_error===
PHP Fatal error:  Cannot use "PARENT" as interface name, as it is reserved in Standard input code on line 1
