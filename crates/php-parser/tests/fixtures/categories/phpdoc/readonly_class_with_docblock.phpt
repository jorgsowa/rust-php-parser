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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "DataObject",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "data",
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
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
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
