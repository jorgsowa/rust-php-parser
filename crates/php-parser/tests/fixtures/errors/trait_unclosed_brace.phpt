===source===
<?php trait A {} class C { use A { m as x; }
===errors===
expected '}', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 23,
              "end": 24
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "m"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 35,
                              "end": 36
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "x"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 42
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 27,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 17,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
