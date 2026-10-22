===source===
<?php $x = new #[Attr] class() {};
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "Attr"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 21
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 17,
                                "end": 21
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 33
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
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
