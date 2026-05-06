===source===
<?php

/**
 * Repository interface
 * @template T
 */
interface Repository {
    /**
     * Find by ID
     */
    public function findById(int $id);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Repository",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "findById",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 140,
                              "end": 143
                            }
                          }
                        },
                        "span": {
                          "start": 140,
                          "end": 143
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 140,
                        "end": 147
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Find by ID\n     */",
                    "span": {
                      "start": 81,
                      "end": 110
                    }
                  }
                }
              },
              "span": {
                "start": 115,
                "end": 149
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Repository interface\n * @template T\n */",
            "span": {
              "start": 7,
              "end": 53
            }
          }
        }
      },
      "span": {
        "start": 54,
        "end": 151
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151
  }
}
