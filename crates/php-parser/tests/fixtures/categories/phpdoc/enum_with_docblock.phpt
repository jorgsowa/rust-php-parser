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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
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
                  "name": "OK",
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
                  "name": "NOT_FOUND",
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
