===source===
<?php

/**
 * Timestamps trait
 * @psalm-require-extends Model
 * @psalm-require-implements Serializable
 */
trait Timestamps {
    /**
     * Creation timestamp
     */
    public DateTime $createdAt;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "Timestamps",
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "createdAt",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "DateTime"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 181,
                          "end": 189
                        }
                      }
                    },
                    "span": {
                      "start": 181,
                      "end": 189
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Creation timestamp\n     */",
                    "span": {
                      "start": 132,
                      "end": 169
                    }
                  }
                }
              },
              "span": {
                "start": 174,
                "end": 200
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Timestamps trait\n * @psalm-require-extends Model\n * @psalm-require-implements Serializable\n */",
            "span": {
              "start": 7,
              "end": 108
            }
          }
        }
      },
      "span": {
        "start": 109,
        "end": 203
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 203
  }
}
