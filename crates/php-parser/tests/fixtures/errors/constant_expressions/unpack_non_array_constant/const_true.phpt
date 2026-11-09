===source===
<?php
const C = [...true];
===errors===
Only arrays and Traversables can be unpacked, true given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, true given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Bool": true
                        },
                        "span": {
                          "start": 20,
                          "end": 24
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
