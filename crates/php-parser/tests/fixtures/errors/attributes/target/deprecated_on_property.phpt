===source===
<?php
class C {
    #[Deprecated] public $q;
}
===errors 8.4===
Attribute "Deprecated" cannot target property (allowed targets: function, method, class constant)
===errors >=8.5===
Attribute "Deprecated" cannot target property (allowed targets: class, function, method, class constant, constant)
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target property (allowed targets: function, method, class constant) in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Attribute "Deprecated" cannot target property (allowed targets: class, function, method, class constant, constant) in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 41,
                      "end": 43
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 32
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 32
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
