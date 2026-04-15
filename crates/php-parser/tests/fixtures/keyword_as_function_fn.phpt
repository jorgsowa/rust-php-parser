===config===
php_rejects=parse-leniency
===source===
<?php function fn() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "fn",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}