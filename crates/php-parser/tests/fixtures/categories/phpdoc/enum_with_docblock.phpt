===source===
<?php

/**
 * HTTP status code enumeration
 * @see RFC 7231
 */
enum Status: int {
    /**
     * Success response
     */
    case OK = 200;

    /**
     * Client error
     */
    case NOT_FOUND = 404;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 7
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 69,
              "end": 75
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 77,
              "end": 80
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "OK",
                    "span": {
                      "start": 132,
                      "end": 134
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 200
                    },
                    "span": {
                      "start": 137,
                      "end": 140
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Success response\n     */",
                    "span": {
                      "start": 87,
                      "end": 122
                    }
                  }
                }
              },
              "span": {
                "start": 127,
                "end": 141
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "NOT_FOUND",
                    "span": {
                      "start": 188,
                      "end": 197
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 404
                    },
                    "span": {
                      "start": 200,
                      "end": 203
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Client error\n     */",
                    "span": {
                      "start": 147,
                      "end": 178
                    }
                  }
                }
              },
              "span": {
                "start": 183,
                "end": 204
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * HTTP status code enumeration\n * @see RFC 7231\n */",
            "span": {
              "start": 7,
              "end": 63
            }
          }
        }
      },
      "span": {
        "start": 64,
        "end": 206
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 206
  }
}
