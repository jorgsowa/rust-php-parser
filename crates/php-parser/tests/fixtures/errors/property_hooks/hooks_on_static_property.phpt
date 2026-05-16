===config===
min_php=8.4
===source===
<?php
class F {
    public static int $x { get => 1; }
}
===errors===
Cannot declare hooks for static property
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "F",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 34,
                          "end": 37
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 37
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 50,
                            "end": 51
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 43,
                        "end": 52
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
===php_error===
PHP Fatal error:  Cannot declare hooks for static property in Standard input code on line 3
