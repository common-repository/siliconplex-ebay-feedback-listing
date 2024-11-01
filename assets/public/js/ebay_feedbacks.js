

function getEbayFeedbacks(baseUrl, feedbacksSettings, page){


    if(typeof feedbacksSettings !== 'object')
        feedbacksSettings = JSON.parse(feedbacksSettings);

    if(isNaN(page)){
        page = 1;
    }

    showLoader();

    jQuery.ajax({

        url: sp_ebay_review.ajax_url, 
        type: "post", 
        dataType: 'json',
        data: { 
                page: page,
                action: "sp_ebay_review_fetch",
                title: 'SP Ebay Reviews' ,
                _ajax_nonce: sp_ebay_review.nonce
              },
        success:function(result){
            hideLoader();
            if(result.Errors==null){
                removeAllRowsFeedback();
                loadData(baseUrl, feedbacksSettings, result);
                
            }else{
                var msg = (result.Errors.LongMessage)?'Error: Ebay API Issue: '+result.Errors.LongMessage:
                'Error: Ebay API Issue: Please Check Your Credentials';
                alert(msg)

            }
        }
    
    });



}



function pgOnClick(baseUrl, feedbacksSettings, element){
    getEbayFeedbacks(baseUrl, feedbacksSettings, element.innerHTML);
}

function pgPrevious(baseUrl, feedbacksSettings){
    current = parseInt(document.getElementById("span_PageNumber").innerHTML)-1;
    if(current>0){
        document.getElementById("span_PageNumber").innerHTML = current;
        getEbayFeedbacks(baseUrl, feedbacksSettings, current);
    }
}

function pgNext(baseUrl, feedbacksSettings){
    current = parseInt(document.getElementById("span_PageNumber").innerHTML)+1;
    total = parseInt(document.getElementById("span_TotalNumberOfPages").innerHTML);

    if(current<=total){
        document.getElementById("span_PageNumber").innerHTML = current;
        getEbayFeedbacks(baseUrl, feedbacksSettings, current);
    }
}


function generatePagination(baseUrl, feedbacksSettings){

    document.getElementById("div_pagination").innerHTML = "";

    current = parseInt(document.getElementById("span_PageNumber").innerHTML);
    total = parseInt(document.getElementById("span_TotalNumberOfPages").innerHTML);

	var pageLimit = 5;
	var upperLimit, lowerLimit;
	var currentPage = lowerLimit = upperLimit = Math.min(current, total);

	for (var b = 1; b < pageLimit && b < total;) {
	    if (lowerLimit > 1 ) {
	        lowerLimit--; b++; 
	    }
	    if (b < pageLimit && upperLimit < total) {
	        upperLimit++; b++; 
	    }
    }
    
    //anchor Previous
    aPrev = document.createElement("a");
    aPrev.href = "#sp-ebay-feedback-container";
    aPrev.onclick = function(){ pgPrevious(baseUrl, feedbacksSettings); };
    aPrev.innerHTML = "&laquo;";
    div_pagination.appendChild(aPrev);

	for (var i = lowerLimit; i <= upperLimit; i++) {

        a = document.createElement("a");
        a.innerHTML = i;
        a.id = "pg"+i;
        a.href = "#sp-ebay-feedback-container";
        a.onclick = function(){ pgOnClick(baseUrl, feedbacksSettings, this); };
        a.classList.remove("active");
	    if (i == currentPage){
	    	a.classList.add("active");
        }
        div_pagination.appendChild(a);
    }

    //anchor Next
    aNext = document.createElement("a");
    aNext.href = "#sp-ebay-feedback-container";
    aNext.onclick = function(){ pgNext(baseUrl, feedbacksSettings); };
    aNext.innerHTML = "&raquo;";
    div_pagination.appendChild(aNext);
    
}


function loadData(baseUrl, feedbacksSettings, data){

    // jsonObjData = JSON.parse(data);
    jsonObjData = data;


    //populate table
    var feedbackDetails = jsonObjData.FeedbackDetailArray.FeedbackDetail;
    if(feedbackDetails.length>0){

        //
        document.getElementById("span_TotalNumberOfEntries").innerHTML = jsonObjData.PaginationResult.TotalNumberOfEntries;
        document.getElementById("span_PageNumber").innerHTML = jsonObjData.PageNumber;
        document.getElementById("span_TotalNumberOfPages").innerHTML = jsonObjData.PaginationResult.TotalNumberOfPages;

        generatePagination(baseUrl, feedbacksSettings);

        for (i = 0; i < feedbackDetails.length; i++) {
            addRowFeedback(baseUrl, feedbacksSettings, feedbackDetails[i]);
        }
    }
    else{
        if (!document.getElementById) return;

        tabBody = document.getElementById("tblFeedback");
        row = document.createElement("tr");
        cell = document.createElement("td");
        cell.colSpan = "4";

        text = document.createTextNode("No feedbacks found!");
        cell.appendChild(text);
        row.appendChild(cell);

        tabBody.appendChild(row);
    }
    
    

    
}

function showLoader(){
    document.getElementById("div_loader").style.display = "block";
    document.getElementById("div_feedbacks").style.display = "none";
}

function hideLoader(){
    document.getElementById("div_loader").style.display = "none";
    document.getElementById("div_feedbacks").style.display = "block";
}

function removeAllRowsFeedback(){
    var tabBody = document.getElementById("tblFeedback");
    while(tabBody.hasChildNodes())
    {
        tabBody.removeChild(tabBody.firstChild);
    }
}


function addRowFeedback(baseUrl, feedbacksSettings, feedbackDetail)
{
    if (!document.getElementById) return;

    tabBody = document.getElementById("tblFeedback");

    row = document.createElement("tr");

    //image
    imageCell = document.createElement("td");
    imgTag = document.createElement("img");
    imgTag.alt = "type";
    imgTag.height = 16;
    imgTag.width = 16;
    imgTag.className = "sentiment-tag";
    switch (feedbackDetail.CommentType) {
        case "Positive":
            imgTag.src = baseUrl+"assets/public/images/feedback_type_icons/Positive.png";
            break;
        case "Negative":
            imgTag.src = baseUrl+"assets/public/images/feedback_type_icons/Negative.png";
            break;
        default:
            imgTag.src = baseUrl+"assets/public/images/feedback_type_icons/Neutral.png";
            break;
    }
    imageCell.appendChild(imgTag);
    row.appendChild(imageCell);


    //feedback
    feedbackCell = document.createElement("td");
    pTag = document.createElement("p");
    strongTag = document.createElement("strong");
    commentText = document.createTextNode(feedbackDetail.CommentText);
    strongTag.appendChild(commentText);
    pTag.appendChild(strongTag);
    feedbackCell.appendChild(pTag);
    if(feedbackDetail.ItemTitle !== undefined){
        pTag = document.createElement("p");
        itemText = document.createTextNode(feedbackDetail.ItemTitle);
        pTag.appendChild(itemText);
        feedbackCell.appendChild(pTag);
    }
    row.appendChild(feedbackCell);


    //buyer
    buyerCell = document.createElement("td");
    pTag = document.createElement("p");
    strongTag = document.createElement("strong");
    userText = document.createTextNode(feedbackDetail.CommentingUser);
    strongTag.appendChild(userText);
    scoreText = document.createTextNode(" ("+feedbackDetail.CommentingUserScore+")");
    pTag.appendChild(strongTag);
    pTag.appendChild(scoreText);
    buyerCell.appendChild(pTag);
    row.appendChild(buyerCell);
    
    
    //when
    whenCell = document.createElement("td");
    whenDateTime = moment(feedbackDetail.CommentTime).format(feedbacksSettings.datetime_format);
    whenText = document.createTextNode(whenDateTime);
    whenCell.appendChild(whenText);
    row.appendChild(whenCell);


    tabBody.appendChild(row);


}