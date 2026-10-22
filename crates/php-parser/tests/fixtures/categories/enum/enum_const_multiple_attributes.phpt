===source===
<?php enum Status { #[Attr1] #[Attr2('value')] const X = 1; }
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr1"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 27
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 27
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "Attr2"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 36
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "String": "value"
                              },
                              "span": {
                                "start": 37,
                                "end": 44
                              }
                            }
                          },
                          "span": {
                            "start": 37,
                            "end": 44
                          }
                        }
                      ],
                      "span": {
                        "start": 31,
                        "end": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 47,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
