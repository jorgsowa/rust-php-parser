===source===
<?php use ; class Foo {}
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
        "start": 12,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
