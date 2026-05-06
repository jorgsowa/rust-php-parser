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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Value",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "value",
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
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
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
