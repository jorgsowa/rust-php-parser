===source===
<?php interface A extends self {}
===errors===
cannot use 'self' as class name
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
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 30
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
===php_error===
PHP Fatal error:  Cannot use "self" as interface name, as it is reserved in Standard input code on line 1
