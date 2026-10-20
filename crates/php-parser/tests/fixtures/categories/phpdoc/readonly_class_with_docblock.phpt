===source===
<?php

/**
 * Immutable data transfer object
 * @template T
 */
readonly class DataObject {
    /**
     * Initialize data
     */
    public function __construct(public string $data) {}
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 7
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 7
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DataObject",
            "span": {
              "start": 79,
              "end": 89
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
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
                      "start": 151,
                      "end": 162
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "data",
                        "span": {
                          "start": 177,
                          "end": 182
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 170,
                              "end": 176
                            }
                          }
                        },
                        "span": {
                          "start": 170,
                          "end": 176
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 163,
                        "end": 182
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Initialize data\n     */",
                    "span": {
                      "start": 96,
                      "end": 130
                    }
                  }
                }
              },
              "span": {
                "start": 135,
                "end": 186
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Immutable data transfer object\n * @template T\n */",
            "span": {
              "start": 7,
              "end": 63
            }
          }
        }
      },
      "span": {
        "start": 73,
        "end": 188
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 188
  }
}
