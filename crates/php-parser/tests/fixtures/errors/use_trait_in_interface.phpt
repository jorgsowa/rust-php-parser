===source===
<?php
interface I { use T; }
===errors >=8.5===
Cannot use traits inside of interfaces. T is used in I
===php_error===
PHP Fatal error:  Cannot use traits inside of interfaces. T is used in I in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 20,
                "end": 26
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
