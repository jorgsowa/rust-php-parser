===source===
<?php

/**
 * Final immutable value object
 * @template T
 */
final class Value {
    /**
     * Create value
     */
    public function __construct(private mixed $value) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 11
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Value",
            "span": {
              "start": 74,
              "end": 79
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 138,
                      "end": 149
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "value",
                        "span": {
                          "start": 164,
                          "end": 170
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "mixed"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 158,
                              "end": 163
                            }
                          }
                        },
                        "span": {
                          "start": 158,
                          "end": 163
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 150,
                        "end": 170
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Create value\n     */",
                    "span": {
                      "start": 86,
                      "end": 117
                    }
                  }
                }
              },
              "span": {
                "start": 122,
                "end": 174
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Final immutable value object\n * @template T\n */",
            "span": {
              "start": 7,
              "end": 61
            }
          }
        }
      },
      "span": {
        "start": 68,
        "end": 176
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176
  }
}
