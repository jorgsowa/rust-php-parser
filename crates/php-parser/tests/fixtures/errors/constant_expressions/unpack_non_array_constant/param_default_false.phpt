===source===
<?php
function f($a = [...false]) {}
===errors===
Only arrays and Traversables can be unpacked, false given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, false given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Bool": false
                          },
                          "span": {
                            "start": 26,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 22,
                  "end": 32
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 32
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
